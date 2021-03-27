import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { ICovid, Covid } from 'app/shared/model/covid.model';
import { CovidService } from './covid.service';
import { CovidComponent } from './covid.component';
import { CovidDetailComponent } from './covid-detail.component';
import { CovidUpdateComponent } from './covid-update.component';

@Injectable({ providedIn: 'root' })
export class CovidResolve implements Resolve<ICovid> {
  constructor(private service: CovidService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<ICovid> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((covid: HttpResponse<Covid>) => {
          if (covid.body) {
            return of(covid.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new Covid());
  }
}

export const covidRoute: Routes = [
  {
    path: '',
    component: CovidComponent,
    data: {
      authorities: [Authority.USER],
      defaultSort: 'id,asc',
      pageTitle: 'Covids',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: CovidDetailComponent,
    resolve: {
      covid: CovidResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Covids',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: CovidUpdateComponent,
    resolve: {
      covid: CovidResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Covids',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: CovidUpdateComponent,
    resolve: {
      covid: CovidResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Covids',
    },
    canActivate: [UserRouteAccessService],
  },
];
