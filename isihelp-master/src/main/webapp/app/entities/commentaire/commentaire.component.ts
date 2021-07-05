import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Subscription } from 'rxjs';
import { JhiEventManager } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { ICommentaire } from 'app/shared/model/commentaire.model';
import { CommentaireService } from './commentaire.service';
import { CommentaireDeleteDialogComponent } from './commentaire-delete-dialog.component';

@Component({
  selector: 'jhi-commentaire',
  templateUrl: './commentaire.component.html',
})
export class CommentaireComponent implements OnInit, OnDestroy {
  commentaires?: ICommentaire[];
  eventSubscriber?: Subscription;

  constructor(
    protected commentaireService: CommentaireService,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal
  ) {}

  loadAll(): void {
    this.commentaireService.query().subscribe((res: HttpResponse<ICommentaire[]>) => (this.commentaires = res.body || []));
  }

  ngOnInit(): void {
    this.loadAll();
    this.registerChangeInCommentaires();
  }

  ngOnDestroy(): void {
    if (this.eventSubscriber) {
      this.eventManager.destroy(this.eventSubscriber);
    }
  }

  trackId(index: number, item: ICommentaire): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInCommentaires(): void {
    this.eventSubscriber = this.eventManager.subscribe('commentaireListModification', () => this.loadAll());
  }

  delete(commentaire: ICommentaire): void {
    const modalRef = this.modalService.open(CommentaireDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.commentaire = commentaire;
  }
}
