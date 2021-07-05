import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { JhiDataUtils } from 'ng-jhipster';

import { IDemande } from 'app/shared/model/demande/demande.model';

@Component({
  selector: 'jhi-demande-detail',
  templateUrl: './demande-detail.component.html'
})
export class DemandeDetailComponent implements OnInit {
  demande: IDemande;

  constructor(protected dataUtils: JhiDataUtils, protected activatedRoute: ActivatedRoute) {}

  ngOnInit() {
    this.activatedRoute.data.subscribe(({ demande }) => {
      this.demande = demande;
    });
  }

  byteSize(field) {
    return this.dataUtils.byteSize(field);
  }

  openFile(contentType, field) {
    return this.dataUtils.openFile(contentType, field);
  }
  previousState() {
    window.history.back();
  }
}
