import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { SoapTestModule } from '../../../test.module';
import { CovidUpdateComponent } from 'app/entities/covid/covid-update.component';
import { CovidService } from 'app/entities/covid/covid.service';
import { Covid } from 'app/shared/model/covid.model';

describe('Component Tests', () => {
  describe('Covid Management Update Component', () => {
    let comp: CovidUpdateComponent;
    let fixture: ComponentFixture<CovidUpdateComponent>;
    let service: CovidService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [SoapTestModule],
        declarations: [CovidUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(CovidUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(CovidUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(CovidService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new Covid(123);
        spyOn(service, 'update').and.returnValue(of(new HttpResponse({ body: entity })));
        comp.updateForm(entity);
        // WHEN
        comp.save();
        tick(); // simulate async

        // THEN
        expect(service.update).toHaveBeenCalledWith(entity);
        expect(comp.isSaving).toEqual(false);
      }));

      it('Should call create service on save for new entity', fakeAsync(() => {
        // GIVEN
        const entity = new Covid();
        spyOn(service, 'create').and.returnValue(of(new HttpResponse({ body: entity })));
        comp.updateForm(entity);
        // WHEN
        comp.save();
        tick(); // simulate async

        // THEN
        expect(service.create).toHaveBeenCalledWith(entity);
        expect(comp.isSaving).toEqual(false);
      }));
    });
  });
});
