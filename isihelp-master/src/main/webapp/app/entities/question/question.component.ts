import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Subscription } from 'rxjs';
import { JhiEventManager } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { IQuestion } from 'app/shared/model/question.model';
import { QuestionService } from './question.service';
import { QuestionDeleteDialogComponent } from './question-delete-dialog.component';

@Component({
  selector: 'jhi-question',
  templateUrl: './question.component.html',
})
export class QuestionComponent implements OnInit, OnDestroy {
  questions?: IQuestion[];
  eventSubscriber?: Subscription;

  constructor(protected questionService: QuestionService, protected eventManager: JhiEventManager, protected modalService: NgbModal) {}

  loadAll(): void {
    this.questionService.query().subscribe((res: HttpResponse<IQuestion[]>) => (this.questions = res.body || []));
  }

  ngOnInit(): void {
    this.loadAll();
    this.registerChangeInQuestions();
  }

  ngOnDestroy(): void {
    if (this.eventSubscriber) {
      this.eventManager.destroy(this.eventSubscriber);
    }
  }

  trackId(index: number, item: IQuestion): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInQuestions(): void {
    this.eventSubscriber = this.eventManager.subscribe('questionListModification', () => this.loadAll());
  }

  delete(question: IQuestion): void {
    const modalRef = this.modalService.open(QuestionDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.question = question;
  }
}
