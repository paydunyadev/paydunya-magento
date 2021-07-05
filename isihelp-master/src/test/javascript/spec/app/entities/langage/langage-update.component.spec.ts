import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { IsiHelpTestModule } from '../../../test.module';
import { LangageUpdateComponent } from 'app/entities/langage/langage-update.component';
import { LangageService } from 'app/entities/langage/langage.service';
import { Langage } from 'app/shared/model/langage.model';

describe('Component Tests', () => {
  describe('Langage Management Update Component', () => {
    let comp: LangageUpdateComponent;
    let fixture: ComponentFixture<LangageUpdateComponent>;
    let service: LangageService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [IsiHelpTestModule],
        declarations: [LangageUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(LangageUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(LangageUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(LangageService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new Langage(123);
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
        const entity = new Langage();
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
