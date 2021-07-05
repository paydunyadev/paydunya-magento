import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { ICommentaire } from 'app/shared/model/commentaire.model';

@Component({
  selector: 'jhi-commentaire-detail',
  templateUrl: './commentaire-detail.component.html',
})
export class CommentaireDetailComponent implements OnInit {
  commentaire: ICommentaire | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ commentaire }) => (this.commentaire = commentaire));
  }

  previousState(): void {
    window.history.back();
  }
}
