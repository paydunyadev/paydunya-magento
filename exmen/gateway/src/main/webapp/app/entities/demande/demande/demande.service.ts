import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared';
import { IDemande } from 'app/shared/model/demande/demande.model';

type EntityResponseType = HttpResponse<IDemande>;
type EntityArrayResponseType = HttpResponse<IDemande[]>;

@Injectable({ providedIn: 'root' })
export class DemandeService {
  public resourceUrl = SERVER_API_URL + 'services/demande/api/demandes';

  constructor(protected http: HttpClient) {}

  create(demande: IDemande): Observable<EntityResponseType> {
    return this.http.post<IDemande>(this.resourceUrl, demande, { observe: 'response' });
  }

  update(demande: IDemande): Observable<EntityResponseType> {
    return this.http.put<IDemande>(this.resourceUrl, demande, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IDemande>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IDemande[]>(this.resourceUrl, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<any>> {
    return this.http.delete<any>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }
}
