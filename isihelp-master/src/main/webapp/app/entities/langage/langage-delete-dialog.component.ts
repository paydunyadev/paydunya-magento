import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { ILangage } from 'app/shared/model/langage.model';
import { LangageService } from './langage.service';

@Component({
  templateUrl: './langage-delete-dialog.component.html',
})
export class LangageDeleteDialogComponent {
  langage?: ILangage;

  constructor(protected langageService: LangageService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.langageService.delete(id).subscribe(() => {
      this.eventManager.broadcast('langageListModification');
      this.activeModal.close();
    });
  }
}
