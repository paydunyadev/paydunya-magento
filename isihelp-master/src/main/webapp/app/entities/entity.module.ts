import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

@NgModule({
  imports: [
    RouterModule.forChild([
      {
        path: 'question',
        loadChildren: () => import('./question/question.module').then(m => m.IsiHelpQuestionModule),
      },
      {
        path: 'commentaire',
        loadChildren: () => import('./commentaire/commentaire.module').then(m => m.IsiHelpCommentaireModule),
      },
      {
        path: 'techno',
        loadChildren: () => import('./techno/techno.module').then(m => m.IsiHelpTechnoModule),
      },
      {
        path: 'langage',
        loadChildren: () => import('./langage/langage.module').then(m => m.IsiHelpLangageModule),
      },
      /* jhipster-needle-add-entity-route - JHipster will add entity modules routes here */
    ]),
  ],
})
export class IsiHelpEntityModule {}
