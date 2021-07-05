/* tslint:disable max-line-length */
import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { Observable, of } from 'rxjs';

import { GatewayTestModule } from '../../../../test.module';
import { TypeUpdateComponent } from 'app/entities/partener/type/type-update.component';
import { TypeService } from 'app/entities/partener/type/type.service';
import { Type } from 'app/shared/model/partener/type.model';

describe('Component Tests', () => {
  describe('Type Management Update Component', () => {
    let comp: TypeUpdateComponent;
    let fixture: ComponentFixture<TypeUpdateComponent>;
    let service: TypeService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [GatewayTestModule],
        declarations: [TypeUpdateComponent],
        providers: [FormBuilder]
      })
        .overrideTemplate(TypeUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(TypeUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(TypeService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new Type(123);
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
        const entity = new Type();
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
