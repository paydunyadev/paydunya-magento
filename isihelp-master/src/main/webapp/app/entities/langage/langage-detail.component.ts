import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { ILangage } from 'app/shared/model/langage.model';

@Component({
  selector: 'jhi-langage-detail',
  templateUrl: './langage-detail.component.html',
})
export class LangageDetailComponent implements OnInit {
  langage: ILangage | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ langage }) => (this.langage = langage));
  }

  previousState(): void {
    window.history.back();
  }
}
