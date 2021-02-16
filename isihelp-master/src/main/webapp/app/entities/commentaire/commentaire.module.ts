import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { IsiHelpSharedModule } from 'app/shared/shared.module';
import { CommentaireComponent } from './commentaire.component';
import { CommentaireDetailComponent } from './commentaire-detail.component';
import { CommentaireUpdateComponent } from './commentaire-update.component';
import { CommentaireDeleteDialogComponent } from './commentaire-delete-dialog.component';
import { commentaireRoute } from './commentaire.route';

@NgModule({
  imports: [IsiHelpSharedModule, RouterModule.forChild(commentaireRoute)],
  declarations: [CommentaireComponent, CommentaireDetailComponent, CommentaireUpdateComponent, CommentaireDeleteDialogComponent],
  entryComponents: [CommentaireDeleteDialogComponent],
})
export class IsiHelpCommentaireModule {}
