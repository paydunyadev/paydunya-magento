import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { ILangage } from 'app/shared/model/langage.model';

type EntityResponseType = HttpResponse<ILangage>;
type EntityArrayResponseType = HttpResponse<ILangage[]>;

@Injectable({ providedIn: 'root' })
export class LangageService {
  public resourceUrl = SERVER_API_URL + 'api/langages';

  constructor(protected http: HttpClient) {}

  create(langage: ILangage): Observable<EntityResponseType> {
    return this.http.post<ILangage>(this.resourceUrl, langage, { observe: 'response' });
  }

  update(langage: ILangage): Observable<EntityResponseType> {
    return this.http.put<ILangage>(this.resourceUrl, langage, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<ILangage>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<ILangage[]>(this.resourceUrl, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }
}
