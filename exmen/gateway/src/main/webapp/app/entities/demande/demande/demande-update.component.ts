import { Component, OnInit, ElementRef } from '@angular/core';
import { HttpResponse, HttpErrorResponse } from '@angular/common/http';
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import { filter, map } from 'rxjs/operators';
import { JhiAlertService, JhiDataUtils } from 'ng-jhipster';
import { IDemande, Demande } from 'app/shared/model/demande/demande.model';
import { DemandeService } from './demande.service';
import { IUser, UserService } from 'app/core';
import { IType } from 'app/shared/model/partener/type.model';
import { TypeService } from 'app/entities/partener/type';

@Component({
  selector: 'jhi-demande-update',
  templateUrl: './demande-update.component.html'
})
export class DemandeUpdateComponent implements OnInit {
  demande: IDemande;
  isSaving: boolean;

  users: IUser[];

  types: IType[];

  editForm = this.fb.group({
    id: [],
    lastName: [null, [Validators.required, Validators.minLength(3)]],
    firstName: [null, [Validators.required, Validators.minLength(2)]],
    imagePiece: [],
    imagePieceContentType: [],
    user: [],
    type: []
  });

  constructor(
    protected dataUtils: JhiDataUtils,
    protected jhiAlertService: JhiAlertService,
    protected demandeService: DemandeService,
    protected userService: UserService,
    protected typeService: TypeService,
    protected elementRef: ElementRef,
    protected activatedRoute: ActivatedRoute,
    private fb: FormBuilder
  ) {}

  ngOnInit() {
    this.isSaving = false;
    this.activatedRoute.data.subscribe(({ demande }) => {
      this.updateForm(demande);
      this.demande = demande;
    });
    this.userService
      .query()
      .pipe(
        filter((mayBeOk: HttpResponse<IUser[]>) => mayBeOk.ok),
        map((response: HttpResponse<IUser[]>) => response.body)
      )
      .subscribe((res: IUser[]) => (this.users = res), (res: HttpErrorResponse) => this.onError(res.message));
    this.typeService
      .query()
      .pipe(
        filter((mayBeOk: HttpResponse<IType[]>) => mayBeOk.ok),
        map((response: HttpResponse<IType[]>) => response.body)
      )
      .subscribe((res: IType[]) => (this.types = res), (res: HttpErrorResponse) => this.onError(res.message));
  }

  updateForm(demande: IDemande) {
    this.editForm.patchValue({
      id: demande.id,
      lastName: demande.lastName,
      firstName: demande.firstName,
      imagePiece: demande.imagePiece,
      imagePieceContentType: demande.imagePieceContentType,
      user: demande.user,
      type: demande.type
    });
  }

  byteSize(field) {
    return this.dataUtils.byteSize(field);
  }

  openFile(contentType, field) {
    return this.dataUtils.openFile(contentType, field);
  }

  setFileData(event, field: string, isImage) {
    return new Promise((resolve, reject) => {
      if (event && event.target && event.target.files && event.target.files[0]) {
        const file = event.target.files[0];
        if (isImage && !/^image\//.test(file.type)) {
          reject(`File was expected to be an image but was found to be ${file.type}`);
        } else {
          const filedContentType: string = field + 'ContentType';
          this.dataUtils.toBase64(file, base64Data => {
            this.editForm.patchValue({
              [field]: base64Data,
              [filedContentType]: file.type
            });
          });
        }
      } else {
        reject(`Base64 data was not set as file could not be extracted from passed parameter: ${event}`);
      }
    }).then(
      () => console.log('blob added'), // sucess
      this.onError
    );
  }

  clearInputImage(field: string, fieldContentType: string, idInput: string) {
    this.editForm.patchValue({
      [field]: null,
      [fieldContentType]: null
    });
    if (this.elementRef && idInput && this.elementRef.nativeElement.querySelector('#' + idInput)) {
      this.elementRef.nativeElement.querySelector('#' + idInput).value = null;
    }
  }

  previousState() {
    window.history.back();
  }

  save() {
    this.isSaving = true;
    const demande = this.createFromForm();
    if (demande.id !== undefined) {
      this.subscribeToSaveResponse(this.demandeService.update(demande));
    } else {
      this.subscribeToSaveResponse(this.demandeService.create(demande));
    }
  }

  private createFromForm(): IDemande {
    const entity = {
      ...new Demande(),
      id: this.editForm.get(['id']).value,
      lastName: this.editForm.get(['lastName']).value,
      firstName: this.editForm.get(['firstName']).value,
      imagePieceContentType: this.editForm.get(['imagePieceContentType']).value,
      imagePiece: this.editForm.get(['imagePiece']).value,
      user: this.editForm.get(['user']).value,
      type: this.editForm.get(['type']).value
    };
    return entity;
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IDemande>>) {
    result.subscribe((res: HttpResponse<IDemande>) => this.onSaveSuccess(), (res: HttpErrorResponse) => this.onSaveError());
  }

  protected onSaveSuccess() {
    this.isSaving = false;
    this.previousState();
  }

  protected onSaveError() {
    this.isSaving = false;
  }
  protected onError(errorMessage: string) {
    this.jhiAlertService.error(errorMessage, null, null);
  }

  trackUserById(index: number, item: IUser) {
    return item.id;
  }

  trackTypeById(index: number, item: IType) {
    return item.id;
  }
}
