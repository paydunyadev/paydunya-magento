import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { ITechno } from 'app/shared/model/techno.model';
import { TechnoService } from './techno.service';

@Component({
  templateUrl: './techno-delete-dialog.component.html',
})
export class TechnoDeleteDialogComponent {
  techno?: ITechno;

  constructor(protected technoService: TechnoService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.technoService.delete(id).subscribe(() => {
      this.eventManager.broadcast('technoListModification');
      this.activeModal.close();
    });
  }
}
