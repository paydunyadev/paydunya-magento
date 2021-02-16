import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IQuestion, Question } from 'app/shared/model/question.model';
import { QuestionService } from './question.service';
import { ITechno } from 'app/shared/model/techno.model';
import { TechnoService } from 'app/entities/techno/techno.service';
import { ILangage } from 'app/shared/model/langage.model';
import { LangageService } from 'app/entities/langage/langage.service';

type SelectableEntity = ITechno | ILangage;

@Component({
  selector: 'jhi-question-update',
  templateUrl: './question-update.component.html',
})
export class QuestionUpdateComponent implements OnInit {
  isSaving = false;
  technos: ITechno[] = [];
  langages: ILangage[] = [];
  dateDp: any;

  editForm = this.fb.group({
    id: [],
    libelle: [],
    date: [],
    cloturer: [],
    techno: [],
    langage: [],
  });

  constructor(
    protected questionService: QuestionService,
    protected technoService: TechnoService,
    protected langageService: LangageService,
    protected activatedRoute: ActivatedRoute,
    private fb: FormBuilder
  ) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ question }) => {
      this.updateForm(question);

      this.technoService.query().subscribe((res: HttpResponse<ITechno[]>) => (this.technos = res.body || []));

      this.langageService.query().subscribe((res: HttpResponse<ILangage[]>) => (this.langages = res.body || []));
    });
  }

  updateForm(question: IQuestion): void {
    this.editForm.patchValue({
      id: question.id,
      libelle: question.libelle,
      date: question.date,
      cloturer: question.cloturer,
      techno: question.techno,
      langage: question.langage,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const question = this.createFromForm();
    if (question.id !== undefined) {
      this.subscribeToSaveResponse(this.questionService.update(question));
    } else {
      this.subscribeToSaveResponse(this.questionService.create(question));
    }
  }

  private createFromForm(): IQuestion {
    return {
      ...new Question(),
      id: this.editForm.get(['id'])!.value,
      libelle: this.editForm.get(['libelle'])!.value,
      date: this.editForm.get(['date'])!.value,
      cloturer: this.editForm.get(['cloturer'])!.value,
      techno: this.editForm.get(['techno'])!.value,
      langage: this.editForm.get(['langage'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IQuestion>>): void {
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

  trackById(index: number, item: SelectableEntity): any {
    return item.id;
  }
}
