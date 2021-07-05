import { IQuestion } from 'app/shared/model/question.model';

export interface ILangage {
  id?: number;
  libelle?: string;
  publish?: boolean;
  questions?: IQuestion[];
}

export class Langage implements ILangage {
  constructor(public id?: number, public libelle?: string, public publish?: boolean, public questions?: IQuestion[]) {
    this.publish = this.publish || false;
  }
}
