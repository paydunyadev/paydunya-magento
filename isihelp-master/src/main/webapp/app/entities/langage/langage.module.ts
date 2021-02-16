import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { IsiHelpSharedModule } from 'app/shared/shared.module';
import { LangageComponent } from './langage.component';
import { LangageDetailComponent } from './langage-detail.component';
import { LangageUpdateComponent } from './langage-update.component';
import { LangageDeleteDialogComponent } from './langage-delete-dialog.component';
import { langageRoute } from './langage.route';

@NgModule({
  imports: [IsiHelpSharedModule, RouterModule.forChild(langageRoute)],
  declarations: [LangageComponent, LangageDetailComponent, LangageUpdateComponent, LangageDeleteDialogComponent],
  entryComponents: [LangageDeleteDialogComponent],
})
export class IsiHelpLangageModule {}
