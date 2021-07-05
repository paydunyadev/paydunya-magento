import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { IsiHelpTestModule } from '../../../test.module';
import { LangageDetailComponent } from 'app/entities/langage/langage-detail.component';
import { Langage } from 'app/shared/model/langage.model';

describe('Component Tests', () => {
  describe('Langage Management Detail Component', () => {
    let comp: LangageDetailComponent;
    let fixture: ComponentFixture<LangageDetailComponent>;
    const route = ({ data: of({ langage: new Langage(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [IsiHelpTestModule],
        declarations: [LangageDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(LangageDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(LangageDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load langage on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.langage).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
