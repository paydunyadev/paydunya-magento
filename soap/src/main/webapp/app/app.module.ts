import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import './vendor';
import { SoapSharedModule } from 'app/shared/shared.module';
import { SoapCoreModule } from 'app/core/core.module';
import { SoapAppRoutingModule } from './app-routing.module';
import { SoapHomeModule } from './home/home.module';
import { SoapEntityModule } from './entities/entity.module';
// jhipster-needle-angular-add-module-import JHipster will add new module here
import { MainComponent } from './layouts/main/main.component';
import { NavbarComponent } from './layouts/navbar/navbar.component';
import { FooterComponent } from './layouts/footer/footer.component';
import { PageRibbonComponent } from './layouts/profiles/page-ribbon.component';
import { ErrorComponent } from './layouts/error/error.component';

@NgModule({
  imports: [
    BrowserModule,
    SoapSharedModule,
    SoapCoreModule,
    SoapHomeModule,
    // jhipster-needle-angular-add-module JHipster will add new module here
    SoapEntityModule,
    SoapAppRoutingModule,
  ],
  declarations: [MainComponent, NavbarComponent, ErrorComponent, PageRibbonComponent, FooterComponent],
  bootstrap: [MainComponent],
})
export class SoapAppModule {}
