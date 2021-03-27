import { Component, OnInit } from '@angular/core';
import { HttpResponse, HttpErrorResponse } from '@angular/common/http';
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import { IType, Type } from 'app/shared/model/demande/type.model';
import { TypeService } from './type.service';

@Component({
  selector: 'jhi-type-update',
  templateUrl: './type-update.component.html'
})
export class TypeUpdateComponent implements OnInit {
  type: IType;
  isSaving: boolean;

  editForm = this.fb.group({
    id: [],
    title: [null, [Validators.required]]
  });

  constructor(protected typeService: TypeService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit() {
    this.isSaving = false;
    this.activatedRoute.data.subscribe(({ type }) => {
      this.updateForm(type);
      this.type = type;
    });
  }

  updateForm(type: IType) {
    this.editForm.patchValue({
      id: type.id,
      title: type.title
    });
  }

  previousState() {
    window.history.back();
  }

  save() {
    this.isSaving = true;
    const type = this.createFromForm();
    if (type.id !== undefined) {
      this.subscribeToSaveResponse(this.typeService.update(type));
    } else {
      this.subscribeToSaveResponse(this.typeService.create(type));
    }
  }

  private createFromForm(): IType {
    const entity = {
      ...new Type(),
      id: this.editForm.get(['id']).value,
      title: this.editForm.get(['title']).value
    };
    return entity;
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IType>>) {
    result.subscribe((res: HttpResponse<IType>) => this.onSaveSuccess(), (res: HttpErrorResponse) => this.onSaveError());
  }

  protected onSaveSuccess() {
    this.isSaving = false;
    this.previousState();
  }

  protected onSaveError() {
    this.isSaving = false;
  }
}
