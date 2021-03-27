import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { RouterModule } from '@angular/router';
import { JhiLanguageService } from 'ng-jhipster';
import { JhiLanguageHelper } from 'app/core';

import { GatewaySharedModule } from 'app/shared';
import {
  DemandeComponent,
  DemandeDetailComponent,
  DemandeUpdateComponent,
  DemandeDeletePopupComponent,
  DemandeDeleteDialogComponent,
  demandeRoute,
  demandePopupRoute
} from './';

const ENTITY_STATES = [...demandeRoute, ...demandePopupRoute];

@NgModule({
  imports: [GatewaySharedModule, RouterModule.forChild(ENTITY_STATES)],
  declarations: [
    DemandeComponent,
    DemandeDetailComponent,
    DemandeUpdateComponent,
    DemandeDeleteDialogComponent,
    DemandeDeletePopupComponent
  ],
  entryComponents: [DemandeComponent, DemandeUpdateComponent, DemandeDeleteDialogComponent, DemandeDeletePopupComponent],
  providers: [{ provide: JhiLanguageService, useClass: JhiLanguageService }],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class DemandeDemandeModule {
  constructor(private languageService: JhiLanguageService, private languageHelper: JhiLanguageHelper) {
    this.languageHelper.language.subscribe((languageKey: string) => {
      if (languageKey !== undefined) {
        this.languageService.changeLanguage(languageKey);
      }
    });
  }
}
