import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import './vendor';
import { IsiHelpSharedModule } from 'app/shared/shared.module';
import { IsiHelpCoreModule } from 'app/core/core.module';
import { IsiHelpAppRoutingModule } from './app-routing.module';
import { IsiHelpHomeModule } from './home/home.module';
import { IsiHelpEntityModule } from './entities/entity.module';
// jhipster-needle-angular-add-module-import JHipster will add new module here
import { MainComponent } from './layouts/main/main.component';
import { NavbarComponent } from './layouts/navbar/navbar.component';
import { FooterComponent } from './layouts/footer/footer.component';
import { PageRibbonComponent } from './layouts/profiles/page-ribbon.component';
import { ErrorComponent } from './layouts/error/error.component';

@NgModule({
  imports: [
    BrowserModule,
    IsiHelpSharedModule,
    IsiHelpCoreModule,
    IsiHelpHomeModule,
    // jhipster-needle-angular-add-module JHipster will add new module here
    IsiHelpEntityModule,
    IsiHelpAppRoutingModule,
  ],
  declarations: [MainComponent, NavbarComponent, ErrorComponent, PageRibbonComponent, FooterComponent],
  bootstrap: [MainComponent],
})
export class IsiHelpAppModule {}
