/* tslint:disable max-line-length */
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { GatewayTestModule } from '../../../../test.module';
import { TypeDetailComponent } from 'app/entities/partener/type/type-detail.component';
import { Type } from 'app/shared/model/partener/type.model';

describe('Component Tests', () => {
  describe('Type Management Detail Component', () => {
    let comp: TypeDetailComponent;
    let fixture: ComponentFixture<TypeDetailComponent>;
    const route = ({ data: of({ type: new Type(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [GatewayTestModule],
        declarations: [TypeDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }]
      })
        .overrideTemplate(TypeDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(TypeDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should call load all on init', () => {
        // GIVEN

        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.type).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
