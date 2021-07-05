import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import * as moment from 'moment';

import { DATE_FORMAT } from 'app/shared/constants/input.constants';
import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { ICovid } from 'app/shared/model/covid.model';

type EntityResponseType = HttpResponse<ICovid>;
type EntityArrayResponseType = HttpResponse<ICovid[]>;

@Injectable({ providedIn: 'root' })
export class CovidService {
  public resourceUrl = SERVER_API_URL + 'api/covids';

  constructor(protected http: HttpClient) {}

  create(covid: ICovid): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(covid);
    return this.http
      .post<ICovid>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  update(covid: ICovid): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(covid);
    return this.http
      .put<ICovid>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http
      .get<ICovid>(`${this.resourceUrl}/${id}`, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http
      .get<ICovid[]>(this.resourceUrl, { params: options, observe: 'response' })
      .pipe(map((res: EntityArrayResponseType) => this.convertDateArrayFromServer(res)));
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  protected convertDateFromClient(covid: ICovid): ICovid {
    const copy: ICovid = Object.assign({}, covid, {
      date: covid.date && covid.date.isValid() ? covid.date.format(DATE_FORMAT) : undefined,
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
      res.body.forEach((covid: ICovid) => {
        covid.date = covid.date ? moment(covid.date) : undefined;
      });
    }
    return res;
  }
}
