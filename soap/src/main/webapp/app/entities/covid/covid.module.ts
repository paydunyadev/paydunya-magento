import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { SoapSharedModule } from 'app/shared/shared.module';
import { CovidComponent } from './covid.component';
import { CovidDetailComponent } from './covid-detail.component';
import { CovidUpdateComponent } from './covid-update.component';
import { CovidDeleteDialogComponent } from './covid-delete-dialog.component';
import { covidRoute } from './covid.route';

@NgModule({
  imports: [SoapSharedModule, RouterModule.forChild(covidRoute)],
  declarations: [CovidComponent, CovidDetailComponent, CovidUpdateComponent, CovidDeleteDialogComponent],
  entryComponents: [CovidDeleteDialogComponent],
})
export class SoapCovidModule {}
