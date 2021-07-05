import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { ICommentaire } from 'app/shared/model/commentaire.model';
import { CommentaireService } from './commentaire.service';

@Component({
  templateUrl: './commentaire-delete-dialog.component.html',
})
export class CommentaireDeleteDialogComponent {
  commentaire?: ICommentaire;

  constructor(
    protected commentaireService: CommentaireService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.commentaireService.delete(id).subscribe(() => {
      this.eventManager.broadcast('commentaireListModification');
      this.activeModal.close();
    });
  }
}
