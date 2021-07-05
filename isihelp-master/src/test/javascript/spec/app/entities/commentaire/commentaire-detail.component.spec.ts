import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { IsiHelpTestModule } from '../../../test.module';
import { CommentaireDetailComponent } from 'app/entities/commentaire/commentaire-detail.component';
import { Commentaire } from 'app/shared/model/commentaire.model';

describe('Component Tests', () => {
  describe('Commentaire Management Detail Component', () => {
    let comp: CommentaireDetailComponent;
    let fixture: ComponentFixture<CommentaireDetailComponent>;
    const route = ({ data: of({ commentaire: new Commentaire(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [IsiHelpTestModule],
        declarations: [CommentaireDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(CommentaireDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(CommentaireDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load commentaire on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.commentaire).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
