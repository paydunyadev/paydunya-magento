import { ComponentFixture, TestBed } from '@angular/core/testing';
import { of } from 'rxjs';
import { HttpHeaders, HttpResponse } from '@angular/common/http';

import { IsiHelpTestModule } from '../../../test.module';
import { QuestionComponent } from 'app/entities/question/question.component';
import { QuestionService } from 'app/entities/question/question.service';
import { Question } from 'app/shared/model/question.model';

describe('Component Tests', () => {
  describe('Question Management Component', () => {
    let comp: QuestionComponent;
    let fixture: ComponentFixture<QuestionComponent>;
    let service: QuestionService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [IsiHelpTestModule],
        declarations: [QuestionComponent],
      })
        .overrideTemplate(QuestionComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(QuestionComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(QuestionService);
    });

    it('Should call load all on init', () => {
      // GIVEN
      const headers = new HttpHeaders().append('link', 'link;link');
      spyOn(service, 'query').and.returnValue(
        of(
          new HttpResponse({
            body: [new Question(123)],
            headers,
          })
        )
      );

      // WHEN
      comp.ngOnInit();

      // THEN
      expect(service.query).toHaveBeenCalled();
      expect(comp.questions && comp.questions[0]).toEqual(jasmine.objectContaining({ id: 123 }));
    });
  });
});
