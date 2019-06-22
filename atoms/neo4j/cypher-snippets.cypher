
// bad
//CREATE (ep:ElementaryParticle { name: "electron", chargeSign: "-", charge: 1, spin: 0.5 })
//CREATE (ep:ElementaryParticle { name: "proton", chargeSign: "+", charge: 1, spin: 0.5, isospin: 0.5, parity: +1 })
//CREATE (ep:ElementaryParticle { name: "neutron", chargeSign: "0", charge: 0, spin: 0.5, isospin: -0.5, parity: +1 })

// labels are like table names, except more like tags
// instead of creating foreign keys on data between tables, you can chain labels
// together: CREATE (NodeName:Lable1:Label2:SomeOtherLabel)




//
// CREATE (ep:ElementaryParticle:PARTICLE { })
//
//
//
// CREATE (e:Electron {label: ElementaryParticle})
// CREATE (e:Proton {label: ElementaryParticle})
// CREATE (e:Neutron {label: ElementaryParticle})


// Groups and Periods are like lat/lng coordinates in the Periodic Table
// relationship BELONGS_TO_ELEMENTCATEGORY, BELONGS_TO_GROUP, BELONGS_TO_PERIOD
// CREATE (Group:Column {description: "A column in the periodic table"})
// CREATE (Period:Row {description: ""})
CREATE (ElementCategory:Category {description: ""})


// Relationships

// ElementCategory
// Block (s,p,d,f,g)
// NaturalOccurrence (primordial, from decay, synthetic)



CREATE (AlkaliMetal:ElementCategory {name: "AlkaliMetal"})
CREATE (AlkalineEarthMetal:ElementCategory {name: "AlkalineEarthMetal"})
CREATE (Lanthanide:ElementCategory {name: "Lanthanide"})
// relationship to Lanthanide ^
CREATE (RareEarthMetal {name: "RareEarthMetal"})
// (Lanthanides, and the TransitionMetal types Scandium & Yttrium) relationship to RareEarthMetal ^
CREATE (TransitionMetal:ElementCategory {name: "TransitionMetal"})
CREATE (Actinide:ElementCategory {name: "Actinide"})
CREATE (PostTransitionMetal:ElementCategory {name: "PostTransitionMetal"}) // P-block metals
CREATE (Metalloid:ElementCategory {name: "Metalloid"})
CREATE (ReactiveNonMetal:ElementCategory {name: "ReactiveNonMetal"})
CREATE (NobleGas:ElementCategory {name: "NobleGas"})
CREATE (Unknown:ElementCategory {name: "Unknown"})

CREATE (s:Block {name: "s-block"})
CREATE (p:Block {name: "p-block"})
CREATE (d:Block {name: "d-block"})
CREATE (f:Block {name: "f-block"})
CREATE (g:Block {name: "g-block"})


// CREATE (i:Isotope { atomName: "Hydrogen-1", isotopeName: "protium", electrons: 1, protons: 1, neutrons: 0, periodicTableSymbol: "sup(1)H", atomicNumber: 1, atomicMass: "1.007825032241(94) u" })
// CREATE (i:Isotope { atomName: "Hydrogen-2", isotopeName: "deuterium", electrons: 1, protons: 1, neutrons: 1, periodicTableSymbol: "sup(2)H", atomicNumber: 1, atomicMass: "2.01410177811(12) u" })
// CREATE (i:Isotope { atomName: "Hydrogen-3", isotopeName: "tritium", electrons: 1, protons: 1, neutrons: 2, periodicTableSymbol: "sup(3)H", atomicNumber: 1, atomicMass: "3.01604928199(23) u" })
// CREATE (i:Isotope { atomName: "Hydrogen-4", isotopeName: "Hydrogen-4" electrons: 1, protons: 1, neutrons: 3, periodicTableSymbol: "sup(4)H", atomicNumber: 1, atomicMass: "4.02643(11) u" })

// ReactiveNonMetal
CREATE (Hydrogen:Atom {name: "Hydrogen", period: 1, group: 1, standardAtomicWeight: 1.008, protons: 1, electronConfiguration: "1s1", electronsPerShell: 1, periodicTableSymbol: "H" })
// NobleGas
CREATE (Helium:Atom {name: "Helium", period: 1, group: 18, groupName: "NobleGas", standardAtomicWeight: "4.002602(2)", protons: 2, electronConfiguration: "1s2", electronsPerShell: 2, periodicTableSymbol: "He" });
// AlkaliMetal
CREATE (Lithium:Atom {name: "Lithium", period: 2, group: 1, standardAtomicWeight: "4.002602(2)", protons: 3, electronConfiguration: "1s3", electronsPerShell: 3, periodicTableSymbol: "Li" })


MATCH (a:Atom) RETURN a;

// create relationships
// MATCH (a:Person),(b:Person)
// WHERE a.name = 'A' AND b.name = 'B'
// CREATE (a)-[r:RELTYPE]->(b)``
// RETURN type(r)

MATCH (Hydrogen:Atom),(s:Block)
WHERE Hydrogen.name = 'Hydrogen' AND s.name = 's-block'
CREATE (Hydrogen)-[r:RELTYPE]->(s)
RETURN type(r)

CREATE (s:Block {name: "s-block"})<-[:Block]-(Hydrogen:Atom {name: "Hydrogen", period: 1, group: 1, standardAtomicWeight: 1.008, protons: 1, electronConfiguration: "1s1", electronsPerShell: 1, periodicTableSymbol: "H" })-[:ReactiveNonMetal]->(ReactiveNonMetal:ElementCategory {name: "ReactiveNonMetal"})
CREATE (s:Block {name: "s-block"})<-[:Block]-(Helium:Atom {name: "Helium", period: 1, group: 18, standardAtomicWeight: "4.002602(2)", protons: 2, electronConfiguration: "1s2", electronsPerShell: 2, periodicTableSymbol: "He" })-[:NobleGas]->(NobleGas:ElementCategory {name: "NobleGas"})

MATCH (a:Atom{name="Hydrogen"} )
SET a.group = 1
RETURN a

// set relationship to periods

-[r:RELTYPE]->(ReactiveNonMetal:ElementCategory {name: "ReactiveNonMetal"})






/// query for rate of change in properties
