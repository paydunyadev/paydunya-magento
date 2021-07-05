import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { IsiHelpTestModule } from '../../../test.module';
import { TechnoDetailComponent } from 'app/entities/techno/techno-detail.component';
import { Techno } from 'app/shared/model/techno.model';

describe('Component Tests', () => {
  describe('Techno Management Detail Component', () => {
    let comp: TechnoDetailComponent;
    let fixture: ComponentFixture<TechnoDetailComponent>;
    const route = ({ data: of({ techno: new Techno(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [IsiHelpTestModule],
        declarations: [TechnoDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(TechnoDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(TechnoDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load techno on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.techno).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
