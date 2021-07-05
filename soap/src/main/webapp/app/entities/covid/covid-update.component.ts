import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { ICovid, Covid } from 'app/shared/model/covid.model';
import { CovidService } from './covid.service';

@Component({
  selector: 'jhi-covid-update',
  templateUrl: './covid-update.component.html',
})
export class CovidUpdateComponent implements OnInit {
  isSaving = false;
  dateDp: any;

  editForm = this.fb.group({
    id: [],
    nbrtest: [],
    positif: [],
    negatif: [],
    gueris: [],
    deces: [],
    date: [],
  });

  constructor(protected covidService: CovidService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ covid }) => {
      this.updateForm(covid);
    });
  }

  updateForm(covid: ICovid): void {
    this.editForm.patchValue({
      id: covid.id,
      nbrtest: covid.nbrtest,
      positif: covid.positif,
      negatif: covid.negatif,
      gueris: covid.gueris,
      deces: covid.deces,
      date: covid.date,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const covid = this.createFromForm();
    if (covid.id !== undefined) {
      this.subscribeToSaveResponse(this.covidService.update(covid));
    } else {
      this.subscribeToSaveResponse(this.covidService.create(covid));
    }
  }

  private createFromForm(): ICovid {
    return {
      ...new Covid(),
      id: this.editForm.get(['id'])!.value,
      nbrtest: this.editForm.get(['nbrtest'])!.value,
      positif: this.editForm.get(['positif'])!.value,
      negatif: this.editForm.get(['negatif'])!.value,
      gueris: this.editForm.get(['gueris'])!.value,
      deces: this.editForm.get(['deces'])!.value,
      date: this.editForm.get(['date'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<ICovid>>): void {
    result.subscribe(
      () => this.onSaveSuccess(),
      () => this.onSaveError()
    );
  }

  protected onSaveSuccess(): void {
    this.isSaving = false;
    this.previousState();
  }

  protected onSaveError(): void {
    this.isSaving = false;
  }
}
