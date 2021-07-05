import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import * as moment from 'moment';

import { DATE_FORMAT } from 'app/shared/constants/input.constants';
import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { ICommentaire } from 'app/shared/model/commentaire.model';

type EntityResponseType = HttpResponse<ICommentaire>;
type EntityArrayResponseType = HttpResponse<ICommentaire[]>;

@Injectable({ providedIn: 'root' })
export class CommentaireService {
  public resourceUrl = SERVER_API_URL + 'api/commentaires';

  constructor(protected http: HttpClient) {}

  create(commentaire: ICommentaire): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(commentaire);
    return this.http
      .post<ICommentaire>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  update(commentaire: ICommentaire): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(commentaire);
    return this.http
      .put<ICommentaire>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http
      .get<ICommentaire>(`${this.resourceUrl}/${id}`, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http
      .get<ICommentaire[]>(this.resourceUrl, { params: options, observe: 'response' })
      .pipe(map((res: EntityArrayResponseType) => this.convertDateArrayFromServer(res)));
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  protected convertDateFromClient(commentaire: ICommentaire): ICommentaire {
    const copy: ICommentaire = Object.assign({}, commentaire, {
      date: commentaire.date && commentaire.date.isValid() ? commentaire.date.format(DATE_FORMAT) : undefined,
    });
    return copy;
  }

  protected convertDateFromServer(res: EntityResponseType): EntityResponseType {
    if (res.body) {
      res.body.date = res.body.date ? moment(res.body.date) : undefined;
    }
    return res;
  }

  protected convertDateArrayFromServer(res: EntityArrayResponseType): EntityArrayResponseType {
    if (res.body) {
      res.body.forEach((commentaire: ICommentaire) => {
        commentaire.date = commentaire.date ? moment(commentaire.date) : undefined;
      });
    }
    return res;
  }
}
