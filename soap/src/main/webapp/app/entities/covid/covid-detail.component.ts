import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { ICovid } from 'app/shared/model/covid.model';

@Component({
  selector: 'jhi-covid-detail',
  templateUrl: './covid-detail.component.html',
})
export class CovidDetailComponent implements OnInit {
  covid: ICovid | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ covid }) => (this.covid = covid));
  }

  previousState(): void {
    window.history.back();
  }
}
