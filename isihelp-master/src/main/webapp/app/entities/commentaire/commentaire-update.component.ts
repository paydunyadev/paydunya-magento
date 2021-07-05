import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { ICommentaire, Commentaire } from 'app/shared/model/commentaire.model';
import { CommentaireService } from './commentaire.service';
import { IQuestion } from 'app/shared/model/question.model';
import { QuestionService } from 'app/entities/question/question.service';

@Component({
  selector: 'jhi-commentaire-update',
  templateUrl: './commentaire-update.component.html',
})
export class CommentaireUpdateComponent implements OnInit {
  isSaving = false;
  questions: IQuestion[] = [];
  dateDp: any;

  editForm = this.fb.group({
    id: [],
    libelle: [],
    date: [],
    vote: [],
    question: [],
  });

  constructor(
    protected commentaireService: CommentaireService,
    protected questionService: QuestionService,
    protected activatedRoute: ActivatedRoute,
    private fb: FormBuilder
  ) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ commentaire }) => {
      this.updateForm(commentaire);

      this.questionService.query().subscribe((res: HttpResponse<IQuestion[]>) => (this.questions = res.body || []));
    });
  }

  updateForm(commentaire: ICommentaire): void {
    this.editForm.patchValue({
      id: commentaire.id,
      libelle: commentaire.libelle,
      date: commentaire.date,
      vote: commentaire.vote,
      question: commentaire.question,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const commentaire = this.createFromForm();
    if (commentaire.id !== undefined) {
      this.subscribeToSaveResponse(this.commentaireService.update(commentaire));
    } else {
      this.subscribeToSaveResponse(this.commentaireService.create(commentaire));
    }
  }

  private createFromForm(): ICommentaire {
    return {
      ...new Commentaire(),
      id: this.editForm.get(['id'])!.value,
      libelle: this.editForm.get(['libelle'])!.value,
      date: this.editForm.get(['date'])!.value,
      vote: this.editForm.get(['vote'])!.value,
      question: this.editForm.get(['question'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<ICommentaire>>): void {
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

  trackById(index: number, item: IQuestion): any {
    return item.id;
  }
}
