import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { SoapTestModule } from '../../../test.module';
import { CovidDetailComponent } from 'app/entities/covid/covid-detail.component';
import { Covid } from 'app/shared/model/covid.model';

describe('Component Tests', () => {
  describe('Covid Management Detail Component', () => {
    let comp: CovidDetailComponent;
    let fixture: ComponentFixture<CovidDetailComponent>;
    const route = ({ data: of({ covid: new Covid(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [SoapTestModule],
        declarations: [CovidDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(CovidDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(CovidDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load covid on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.covid).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
