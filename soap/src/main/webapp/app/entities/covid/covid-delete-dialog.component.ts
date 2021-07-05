import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { ICovid } from 'app/shared/model/covid.model';
import { CovidService } from './covid.service';

@Component({
  templateUrl: './covid-delete-dialog.component.html',
})
export class CovidDeleteDialogComponent {
  covid?: ICovid;

  constructor(protected covidService: CovidService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.covidService.delete(id).subscribe(() => {
      this.eventManager.broadcast('covidListModification');
      this.activeModal.close();
    });
  }
}
