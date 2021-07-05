import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { NgbActiveModal, NgbModal, NgbModalRef } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IType } from 'app/shared/model/partener/type.model';
import { TypeService } from './type.service';

@Component({
  selector: 'jhi-type-delete-dialog',
  templateUrl: './type-delete-dialog.component.html'
})
export class TypeDeleteDialogComponent {
  type: IType;

  constructor(protected typeService: TypeService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  clear() {
    this.activeModal.dismiss('cancel');
  }

  confirmDelete(id: number) {
    this.typeService.delete(id).subscribe(response => {
      this.eventManager.broadcast({
        name: 'typeListModification',
        content: 'Deleted an type'
      });
      this.activeModal.dismiss(true);
    });
  }
}

@Component({
  selector: 'jhi-type-delete-popup',
  template: ''
})
export class TypeDeletePopupComponent implements OnInit, OnDestroy {
  protected ngbModalRef: NgbModalRef;

  constructor(protected activatedRoute: ActivatedRoute, protected router: Router, protected modalService: NgbModal) {}

  ngOnInit() {
    this.activatedRoute.data.subscribe(({ type }) => {
      setTimeout(() => {
        this.ngbModalRef = this.modalService.open(TypeDeleteDialogComponent as Component, { size: 'lg', backdrop: 'static' });
        this.ngbModalRef.componentInstance.type = type;
        this.ngbModalRef.result.then(
          result => {
            this.router.navigate(['/type', { outlets: { popup: null } }]);
            this.ngbModalRef = null;
          },
          reason => {
            this.router.navigate(['/type', { outlets: { popup: null } }]);
            this.ngbModalRef = null;
          }
        );
      }, 0);
    });
  }

  ngOnDestroy() {
    this.ngbModalRef = null;
  }
}
