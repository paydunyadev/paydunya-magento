import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { NgbActiveModal, NgbModal, NgbModalRef } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IDemande } from 'app/shared/model/demande/demande.model';
import { DemandeService } from './demande.service';

@Component({
  selector: 'jhi-demande-delete-dialog',
  templateUrl: './demande-delete-dialog.component.html'
})
export class DemandeDeleteDialogComponent {
  demande: IDemande;

  constructor(protected demandeService: DemandeService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  clear() {
    this.activeModal.dismiss('cancel');
  }

  confirmDelete(id: number) {
    this.demandeService.delete(id).subscribe(response => {
      this.eventManager.broadcast({
        name: 'demandeListModification',
        content: 'Deleted an demande'
      });
      this.activeModal.dismiss(true);
    });
  }
}

@Component({
  selector: 'jhi-demande-delete-popup',
  template: ''
})
export class DemandeDeletePopupComponent implements OnInit, OnDestroy {
  protected ngbModalRef: NgbModalRef;

  constructor(protected activatedRoute: ActivatedRoute, protected router: Router, protected modalService: NgbModal) {}

  ngOnInit() {
    this.activatedRoute.data.subscribe(({ demande }) => {
      setTimeout(() => {
        this.ngbModalRef = this.modalService.open(DemandeDeleteDialogComponent as Component, { size: 'lg', backdrop: 'static' });
        this.ngbModalRef.componentInstance.demande = demande;
        this.ngbModalRef.result.then(
          result => {
            this.router.navigate(['/demande', { outlets: { popup: null } }]);
            this.ngbModalRef = null;
          },
          reason => {
            this.router.navigate(['/demande', { outlets: { popup: null } }]);
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
