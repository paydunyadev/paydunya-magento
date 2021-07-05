import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { IsiHelpSharedModule } from 'app/shared/shared.module';
import { QuestionComponent } from './question.component';
import { QuestionDetailComponent } from './question-detail.component';
import { QuestionUpdateComponent } from './question-update.component';
import { QuestionDeleteDialogComponent } from './question-delete-dialog.component';
import { questionRoute } from './question.route';

@NgModule({
  imports: [IsiHelpSharedModule, RouterModule.forChild(questionRoute)],
  declarations: [QuestionComponent, QuestionDetailComponent, QuestionUpdateComponent, QuestionDeleteDialogComponent],
  entryComponents: [QuestionDeleteDialogComponent],
})
export class IsiHelpQuestionModule {}
