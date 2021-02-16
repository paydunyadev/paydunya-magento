import { ComponentFixture, TestBed } from '@angular/core/testing';
import { of } from 'rxjs';
import { HttpHeaders, HttpResponse } from '@angular/common/http';

import { IsiHelpTestModule } from '../../../test.module';
import { LangageComponent } from 'app/entities/langage/langage.component';
import { LangageService } from 'app/entities/langage/langage.service';
import { Langage } from 'app/shared/model/langage.model';

describe('Component Tests', () => {
  describe('Langage Management Component', () => {
    let comp: LangageComponent;
    let fixture: ComponentFixture<LangageComponent>;
    let service: LangageService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [IsiHelpTestModule],
        declarations: [LangageComponent],
      })
        .overrideTemplate(LangageComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(LangageComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(LangageService);
    });

    it('Should call load all on init', () => {
      // GIVEN
      const headers = new HttpHeaders().append('link', 'link;link');
      spyOn(service, 'query').and.returnValue(
        of(
          new HttpResponse({
            body: [new Langage(123)],
            headers,
          })
        )
      );

      // WHEN
      comp.ngOnInit();

      // THEN
      expect(service.query).toHaveBeenCalled();
      expect(comp.langages && comp.langages[0]).toEqual(jasmine.objectContaining({ id: 123 }));
    });
  });
});
