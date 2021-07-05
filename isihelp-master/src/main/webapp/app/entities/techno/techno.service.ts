import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { ITechno } from 'app/shared/model/techno.model';

type EntityResponseType = HttpResponse<ITechno>;
type EntityArrayResponseType = HttpResponse<ITechno[]>;

@Injectable({ providedIn: 'root' })
export class TechnoService {
  public resourceUrl = SERVER_API_URL + 'api/technos';

  constructor(protected http: HttpClient) {}

  create(techno: ITechno): Observable<EntityResponseType> {
    return this.http.post<ITechno>(this.resourceUrl, techno, { observe: 'response' });
  }

  update(techno: ITechno): Observable<EntityResponseType> {
    return this.http.put<ITechno>(this.resourceUrl, techno, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<ITechno>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<ITechno[]>(this.resourceUrl, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }
}
