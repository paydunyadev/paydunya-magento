import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, RouterStateSnapshot, Routes } from '@angular/router';
import { UserRouteAccessService } from 'app/core';
import { Observable, of } from 'rxjs';
import { filter, map } from 'rxjs/operators';
import { Demande } from 'app/shared/model/demande/demande.model';
import { DemandeService } from './demande.service';
import { DemandeComponent } from './demande.component';
import { DemandeDetailComponent } from './demande-detail.component';
import { DemandeUpdateComponent } from './demande-update.component';
import { DemandeDeletePopupComponent } from './demande-delete-dialog.component';
import { IDemande } from 'app/shared/model/demande/demande.model';

@Injectable({ providedIn: 'root' })
export class DemandeResolve implements Resolve<IDemande> {
  constructor(private service: DemandeService) {}

  resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<IDemande> {
    const id = route.params['id'] ? route.params['id'] : null;
    if (id) {
      return this.service.find(id).pipe(
        filter((response: HttpResponse<Demande>) => response.ok),
        map((demande: HttpResponse<Demande>) => demande.body)
      );
    }
    return of(new Demande());
  }
}

export const demandeRoute: Routes = [
  {
    path: '',
    component: DemandeComponent,
    data: {
      authorities: ['ROLE_USER'],
      pageTitle: 'gatewayApp.demandeDemande.home.title'
    },
    canActivate: [UserRouteAccessService]
  },
  {
    path: ':id/view',
    component: DemandeDetailComponent,
    resolve: {
      demande: DemandeResolve
    },
    data: {
      authorities: ['ROLE_USER'],
      pageTitle: 'gatewayApp.demandeDemande.home.title'
    },
    canActivate: [UserRouteAccessService]
  },
  {
    path: 'new',
    component: DemandeUpdateComponent,
    resolve: {
      demande: DemandeResolve
    },
    data: {
      authorities: ['ROLE_USER'],
      pageTitle: 'gatewayApp.demandeDemande.home.title'
    },
    canActivate: [UserRouteAccessService]
  },
  {
    path: ':id/edit',
    component: DemandeUpdateComponent,
    resolve: {
      demande: DemandeResolve
    },
    data: {
      authorities: ['ROLE_USER'],
      pageTitle: 'gatewayApp.demandeDemande.home.title'
    },
    canActivate: [UserRouteAccessService]
  }
];

export const demandePopupRoute: Routes = [
  {
    path: ':id/delete',
    component: DemandeDeletePopupComponent,
    resolve: {
      demande: DemandeResolve
    },
    data: {
      authorities: ['ROLE_USER'],
      pageTitle: 'gatewayApp.demandeDemande.home.title'
    },
    canActivate: [UserRouteAccessService],
    outlet: 'popup'
  }
];
