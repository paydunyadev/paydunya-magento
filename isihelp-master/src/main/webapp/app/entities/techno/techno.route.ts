import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { ITechno, Techno } from 'app/shared/model/techno.model';
import { TechnoService } from './techno.service';
import { TechnoComponent } from './techno.component';
import { TechnoDetailComponent } from './techno-detail.component';
import { TechnoUpdateComponent } from './techno-update.component';

@Injectable({ providedIn: 'root' })
export class TechnoResolve implements Resolve<ITechno> {
  constructor(private service: TechnoService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<ITechno> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((techno: HttpResponse<Techno>) => {
          if (techno.body) {
            return of(techno.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new Techno());
  }
}

export const technoRoute: Routes = [
  {
    path: '',
    component: TechnoComponent,
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Technos',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: TechnoDetailComponent,
    resolve: {
      techno: TechnoResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Technos',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: TechnoUpdateComponent,
    resolve: {
      techno: TechnoResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Technos',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: TechnoUpdateComponent,
    resolve: {
      techno: TechnoResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'Technos',
    },
    canActivate: [UserRouteAccessService],
  },
];
