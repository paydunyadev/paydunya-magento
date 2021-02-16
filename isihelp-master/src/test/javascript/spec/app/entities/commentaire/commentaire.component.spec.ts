import { ComponentFixture, TestBed } from '@angular/core/testing';
import { of } from 'rxjs';
import { HttpHeaders, HttpResponse } from '@angular/common/http';

import { IsiHelpTestModule } from '../../../test.module';
import { CommentaireComponent } from 'app/entities/commentaire/commentaire.component';
import { CommentaireService } from 'app/entities/commentaire/commentaire.service';
import { Commentaire } from 'app/shared/model/commentaire.model';

describe('Component Tests', () => {
  describe('Commentaire Management Component', () => {
    let comp: CommentaireComponent;
    let fixture: ComponentFixture<CommentaireComponent>;
    let service: CommentaireService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [IsiHelpTestModule],
        declarations: [CommentaireComponent],
      })
        .overrideTemplate(CommentaireComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(CommentaireComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(CommentaireService);
    });

    it('Should call load all on init', () => {
      // GIVEN
      const headers = new HttpHeaders().append('link', 'link;link');
      spyOn(service, 'query').and.returnValue(
        of(
          new HttpResponse({
            body: [new Commentaire(123)],
            headers,
          })
        )
      );

      // WHEN
      comp.ngOnInit();

      // THEN
      expect(service.query).toHaveBeenCalled();
      expect(comp.commentaires && comp.commentaires[0]).toEqual(jasmine.objectContaining({ id: 123 }));
    });
  });
});
