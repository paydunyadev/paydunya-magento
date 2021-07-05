import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { ILangage, Langage } from 'app/shared/model/langage.model';
import { LangageService } from './langage.service';
import { LangageComponent } from './langage.component';
import { LangageDetailComponent } from './langage-detail.component';
import { LangageUpdateComponent } from './langage-update.component';

@Injectable({ providedIn: 'root' })
export class LangageResolve implements Resolve<ILangage> {
  constructor(private service: LangageService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<ILangage> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((langage: HttpResponse<Langage>) => {
          if (langage.body) {
            return of(langage.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new Langage());
  }
}

export const langageRoute: Routes = [
  {
    path: '',
    component: LangageComponent,
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Langages',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: LangageDetailComponent,
    resolve: {
      langage: LangageResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Langages',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: LangageUpdateComponent,
    resolve: {
      langage: LangageResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Langages',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: LangageUpdateComponent,
    resolve: {
      langage: LangageResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Langages',
    },
    canActivate: [UserRouteAccessService],
  },
];
