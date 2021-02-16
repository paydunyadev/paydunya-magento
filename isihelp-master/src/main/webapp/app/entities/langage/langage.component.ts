import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Subscription } from 'rxjs';
import { JhiEventManager } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { ILangage } from 'app/shared/model/langage.model';
import { LangageService } from './langage.service';
import { LangageDeleteDialogComponent } from './langage-delete-dialog.component';

@Component({
  selector: 'jhi-langage',
  templateUrl: './langage.component.html',
})
export class LangageComponent implements OnInit, OnDestroy {
  langages?: ILangage[];
  eventSubscriber?: Subscription;

  constructor(protected langageService: LangageService, protected eventManager: JhiEventManager, protected modalService: NgbModal) {}

  loadAll(): void {
    this.langageService.query().subscribe((res: HttpResponse<ILangage[]>) => (this.langages = res.body || []));
  }

  ngOnInit(): void {
    this.loadAll();
    this.registerChangeInLangages();
  }

  ngOnDestroy(): void {
    if (this.eventSubscriber) {
      this.eventManager.destroy(this.eventSubscriber);
    }
  }

  trackId(index: number, item: ILangage): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInLangages(): void {
    this.eventSubscriber = this.eventManager.subscribe('langageListModification', () => this.loadAll());
  }

  delete(langage: ILangage): void {
    const modalRef = this.modalService.open(LangageDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.langage = langage;
  }
}
