import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { ITechno, Techno } from 'app/shared/model/techno.model';
import { TechnoService } from './techno.service';

@Component({
  selector: 'jhi-techno-update',
  templateUrl: './techno-update.component.html',
})
export class TechnoUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    libelle: [],
    publish: [],
  });

  constructor(protected technoService: TechnoService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ techno }) => {
      this.updateForm(techno);
    });
  }

  updateForm(techno: ITechno): void {
    this.editForm.patchValue({
      id: techno.id,
      libelle: techno.libelle,
      publish: techno.publish,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const techno = this.createFromForm();
    if (techno.id !== undefined) {
      this.subscribeToSaveResponse(this.technoService.update(techno));
    } else {
      this.subscribeToSaveResponse(this.technoService.create(techno));
    }
  }

  private createFromForm(): ITechno {
    return {
      ...new Techno(),
      id: this.editForm.get(['id'])!.value,
      libelle: this.editForm.get(['libelle'])!.value,
      publish: this.editForm.get(['publish'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<ITechno>>): void {
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
