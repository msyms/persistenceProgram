简单工厂模式:用来生产同一等级结构中的任意产品。对与增加新的产品，无能为力
工厂模式 ：用来生产同一等级结构中的固定产品。（支持增加任意产品）   
抽象工厂 ：用来生产不同产品族的全部产品。（对于增加新的产品，无能为力；支持增加产品族）  
以上三种工厂 方法在等级结构和产品族这两个方向上的支持程度不同。所以要根据情况考虑应该使用哪种方法
适用范围：
简单工厂模式：
工厂类负责创建的对象较少，客户只知道传入工厂类的参数，对于如何创建对象不关心。
工厂方法模式：
当一个类不知道它所必须创建对象的类或一个类希望由子类来指定它所创建的对象时，当类将创建对象的职责委托给多个帮助子类中得某一个，并且你希望将哪一个帮助子类是代理者这一信息局部化的时候，可以使用工厂方法模式。
抽象工厂模式：
一个系统不应当依赖于产品类实例何如被创建，组合和表达的细节，这对于所有形态的工厂模式都是重要的。这个系统有多于一个的产品族，而系统只消费其 中某一产品族。同属于同一个产品族的产品是在一起使用的，这一约束必须在系统的设计中体现出来。系统提供一个产品类的库，所有的产品以同样的接口出现，从 而使客户端不依赖于实现。
无论是简单工厂模式、工厂模式还是抽象工厂模式，它们本质上都是将不变的部分提取出来，将可变的部分留作接口，以达到最大程度上的复用。究竟用哪种设计模式更适合，这要根据具体的业务需求来决定