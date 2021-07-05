import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Subscription } from 'rxjs';
import { JhiEventManager } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { ITechno } from 'app/shared/model/techno.model';
import { TechnoService } from './techno.service';
import { TechnoDeleteDialogComponent } from './techno-delete-dialog.component';

@Component({
  selector: 'jhi-techno',
  templateUrl: './techno.component.html',
})
export class TechnoComponent implements OnInit, OnDestroy {
  technos?: ITechno[];
  eventSubscriber?: Subscription;

  constructor(protected technoService: TechnoService, protected eventManager: JhiEventManager, protected modalService: NgbModal) {}

  loadAll(): void {
    this.technoService.query().subscribe((res: HttpResponse<ITechno[]>) => (this.technos = res.body || []));
  }

  ngOnInit(): void {
    this.loadAll();
    this.registerChangeInTechnos();
  }

  ngOnDestroy(): void {
    if (this.eventSubscriber) {
      this.eventManager.destroy(this.eventSubscriber);
    }
  }

  trackId(index: number, item: ITechno): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInTechnos(): void {
    this.eventSubscriber = this.eventManager.subscribe('technoListModification', () => this.loadAll());
  }

  delete(techno: ITechno): void {
    const modalRef = this.modalService.open(TechnoDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.techno = techno;
  }
}
