import { Moment } from 'moment';

export interface ICovid {
  id?: number;
  nbrtest?: string;
  positif?: string;
  negatif?: string;
  gueris?: string;
  deces?: string;
  date?: Moment;
}

export class Covid implements ICovid {
  constructor(
    public id?: number,
    public nbrtest?: string,
    public positif?: string,
    public negatif?: string,
    public gueris?: string,
    public deces?: string,
    public date?: Moment
  ) {}
}
