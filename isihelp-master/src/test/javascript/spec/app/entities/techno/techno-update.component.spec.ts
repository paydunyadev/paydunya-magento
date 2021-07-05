import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { IsiHelpTestModule } from '../../../test.module';
import { TechnoUpdateComponent } from 'app/entities/techno/techno-update.component';
import { TechnoService } from 'app/entities/techno/techno.service';
import { Techno } from 'app/shared/model/techno.model';

describe('Component Tests', () => {
  describe('Techno Management Update Component', () => {
    let comp: TechnoUpdateComponent;
    let fixture: ComponentFixture<TechnoUpdateComponent>;
    let service: TechnoService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [IsiHelpTestModule],
        declarations: [TechnoUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(TechnoUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(TechnoUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(TechnoService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new Techno(123);
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
        const entity = new Techno();
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
