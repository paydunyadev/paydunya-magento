import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { ITechno } from 'app/shared/model/techno.model';

@Component({
  selector: 'jhi-techno-detail',
  templateUrl: './techno-detail.component.html',
})
export class TechnoDetailComponent implements OnInit {
  techno: ITechno | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ techno }) => (this.techno = techno));
  }

  previousState(): void {
    window.history.back();
  }
}
