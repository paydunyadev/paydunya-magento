import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { IsiHelpSharedModule } from 'app/shared/shared.module';
import { TechnoComponent } from './techno.component';
import { TechnoDetailComponent } from './techno-detail.component';
import { TechnoUpdateComponent } from './techno-update.component';
import { TechnoDeleteDialogComponent } from './techno-delete-dialog.component';
import { technoRoute } from './techno.route';

@NgModule({
  imports: [IsiHelpSharedModule, RouterModule.forChild(technoRoute)],
  declarations: [TechnoComponent, TechnoDetailComponent, TechnoUpdateComponent, TechnoDeleteDialogComponent],
  entryComponents: [TechnoDeleteDialogComponent],
})
export class IsiHelpTechnoModule {}
