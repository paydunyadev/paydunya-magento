import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { ICommentaire, Commentaire } from 'app/shared/model/commentaire.model';
import { CommentaireService } from './commentaire.service';
import { CommentaireComponent } from './commentaire.component';
import { CommentaireDetailComponent } from './commentaire-detail.component';
import { CommentaireUpdateComponent } from './commentaire-update.component';

@Injectable({ providedIn: 'root' })
export class CommentaireResolve implements Resolve<ICommentaire> {
  constructor(private service: CommentaireService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<ICommentaire> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((commentaire: HttpResponse<Commentaire>) => {
          if (commentaire.body) {
            return of(commentaire.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new Commentaire());
  }
}

export const commentaireRoute: Routes = [
  {
    path: '',
    component: CommentaireComponent,
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Commentaires',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: CommentaireDetailComponent,
    resolve: {
      commentaire: CommentaireResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Commentaires',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: CommentaireUpdateComponent,
    resolve: {
      commentaire: CommentaireResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Commentaires',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: CommentaireUpdateComponent,
    resolve: {
      commentaire: CommentaireResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Commentaires',
    },
    canActivate: [UserRouteAccessService],
  },
];
