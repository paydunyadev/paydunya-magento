import { ComponentFixture, TestBed } from '@angular/core/testing';
import { of } from 'rxjs';
import { HttpHeaders, HttpResponse } from '@angular/common/http';

import { IsiHelpTestModule } from '../../../test.module';
import { TechnoComponent } from 'app/entities/techno/techno.component';
import { TechnoService } from 'app/entities/techno/techno.service';
import { Techno } from 'app/shared/model/techno.model';

describe('Component Tests', () => {
  describe('Techno Management Component', () => {
    let comp: TechnoComponent;
    let fixture: ComponentFixture<TechnoComponent>;
    let service: TechnoService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [IsiHelpTestModule],
        declarations: [TechnoComponent],
      })
        .overrideTemplate(TechnoComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(TechnoComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(TechnoService);
    });

    it('Should call load all on init', () => {
      // GIVEN
      const headers = new HttpHeaders().append('link', 'link;link');
      spyOn(service, 'query').and.returnValue(
        of(
          new HttpResponse({
            body: [new Techno(123)],
            headers,
          })
        )
      );

      // WHEN
      comp.ngOnInit();

      // THEN
      expect(service.query).toHaveBeenCalled();
      expect(comp.technos && comp.technos[0]).toEqual(jasmine.objectContaining({ id: 123 }));
    });
  });
});
