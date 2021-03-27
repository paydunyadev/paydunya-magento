export interface IType {
  id?: number;
  title?: string;
}

export class Type implements IType {
  constructor(public id?: number, public title?: string) {}
}
