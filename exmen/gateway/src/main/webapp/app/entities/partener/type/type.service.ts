import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared';
import { IType } from 'app/shared/model/partener/type.model';

type EntityResponseType = HttpResponse<IType>;
type EntityArrayResponseType = HttpResponse<IType[]>;

@Injectable({ providedIn: 'root' })
export class TypeService {
  public resourceUrl = SERVER_API_URL + 'services/partener/api/types';

  constructor(protected http: HttpClient) {}

  create(type: IType): Observable<EntityResponseType> {
    return this.http.post<IType>(this.resourceUrl, type, { observe: 'response' });
  }

  update(type: IType): Observable<EntityResponseType> {
    return this.http.put<IType>(this.resourceUrl, type, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IType>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IType[]>(this.resourceUrl, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<any>> {
    return this.http.delete<any>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }
}
